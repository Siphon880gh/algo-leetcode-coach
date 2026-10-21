## Sort starts; lower-bound each end

Build `(start, original index)` and sort by start. For each interval in original order, binary-search the first pair whose start is at least that interval’s end (`bisect_left` on `(end, −inf)` so equal starts still match). Write that stored index, or `-1` if the insertion point is past the last pair.

Merge Intervals (56) unions overlaps. Non-overlapping Intervals (435) counts deletions. Find First and Last Position (34) is the same lower-bound idea on a plain array. Do not scan all n starts per query (n is 2e4). Do not require `j != i`. Do not pick any start `>= end` — it must be the leftmost (smallest start).

Time: O(n log n)  
Space: O(n)

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
