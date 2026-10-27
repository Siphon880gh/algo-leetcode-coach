## Two-part key

1. `cnt = Counter(nums)`.
2. Sort by `(cnt[x], −x)`.

`[1,1,2,2,2,3]` → `[3,1,1,2,2,2]`. `[2,3,1,3,2]` → `[1,3,3,2,2]` (2 and 3 tie; larger first). `[-1,1,-6,4,5,-6,1,4,1]` → `[5,-1,4,4,-6,-6,1,1,1]`.

Do not sort ties ascending; the statement wants decreasing values among equal frequencies.

Time: O(n log n)  
Space: O(n)

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
