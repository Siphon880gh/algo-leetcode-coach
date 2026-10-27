## One walk up, one walk down

`i = 0`.

1. While `i + 1 < n` and `arr[i] < arr[i + 1]`: `i += 1`.
2. If `i == 0` or `i == n − 1`, return false (no rise or no fall).
3. While `i + 1 < n` and `arr[i] > arr[i + 1]`: `i += 1`.
4. Return `i == n − 1`.

A flat step stops both walks, so plateaus fail at step 4.

Do not accept arrays that only rise or only fall. Do not use `≤` or `≥`; the slopes must be strict.

Time: O(n)  
Space: O(1)

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
