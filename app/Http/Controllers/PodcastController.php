<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PodcastEpisode;

class PodcastController extends Controller
{
    public function search(Request $request)
    {
        $query = [
            'term'     => 'movie',
            'media'    => 'podcast',
            'attribute'=> 'titleTerm',
            'limit'    => 20
        ];

        $data = Http::get('https://itunes.apple.com/search?term=movie&media=podcast&attribute=titleTerm&limit=10', $query);

        foreach ($data->json()['results'] as $item) {
            $feed = Http::get($item['feedUrl']);
            $xml = simplexml_load_string($feed->body());
            $podcastName = $xml->channel->title;

            foreach ($xml->channel->item as $episodeXml) {
                if (array_key_exists(0, $episodeXml->xpath('./itunes:duration'))) {
                    try {
                        $duration = is_numeric((string) $episodeXml->xpath('./itunes:duration')[0]) ?
                            $episodeXml->xpath('./itunes:duration')[0] :
                            strtotime('1970-01-01 ' . $episodeXml->xpath('./itunes:duration')[0]);

                        PodcastEpisode::firstOrCreate(['episode_id' => $episodeXml->guid], [
                            'episode_title' => $episodeXml->title,
                            'episode_id'    => $episodeXml->guid,
                            'podcast_name'  => $podcastName,
                            'duration'      => $duration,
                        ]);
                    } catch (\Exception $th) {
                        dump($episodeXml->xpath('./itunes:duration')[0]);
                        dump(is_numeric($episodeXml->xpath('./itunes:duration')[0]));
                        dump($episodeXml->guid);
                        dd($item['feedUrl']);
                    }

                }
            }
        }

        return response($data)->header('Content-Type', 'application/json');
    }
}
