## Exact level

1. `seen = {id}`, `frontier = [id]`; repeat `level` times: next frontier = unseen friends of the frontier.
2. Count every video in `watchedVideos` of the final frontier.
3. Sort by `(count, name)` ascending.

Level 1 from person 0 → `["B","C"]` (B once, C twice). Level 2 → `["D"]`.

Do not include people closer than `level`; the visited set keeps them out. Do not sort by name alone; frequency comes first.

Time: O(V + E + W log W)  
Space: O(V + W)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
