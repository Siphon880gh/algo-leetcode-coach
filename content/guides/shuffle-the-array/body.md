## Two pointers

1. For `i` in 0..n−1: append `nums[i]`, then `nums[i + n]`.

`[2,5,1,3,4,7]`, n = 3 → `[2,3,5,4,1,7]`. `[1,2,3,4,4,3,2,1]`, n = 4 → `[1,4,2,3,3,2,4,1]`.

Do not swap in place naively; that overwrites values. An O(1)-space variant packs two values into each slot (values ≤ 1000).

Time: O(n)  
Space: O(n) output

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
