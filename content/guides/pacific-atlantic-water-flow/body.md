## Search from the oceans, not from every cell

From every cell, downhill search is too slow. Reverse the edges: start BFS or DFS at Pacific border cells and walk to neighbors with height greater or equal (water could have flowed down that edge). Do the same from the Atlantic border. A cell in both visited sets can drain both ways.

Number of Islands (200) counts 4-connected land. Surrounded Regions (130) flips O that cannot reach a border. Swim in Rising Water (778) is a min-max path, not two-ocean reachability.

Do not require a strictly decreasing path. Do not skip corner cells that touch both oceans. Do not BFS downhill from the interior as the main algorithm.

Time: O(m n)  
Space: O(m n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
