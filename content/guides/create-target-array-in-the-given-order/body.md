## Simulate inserts

1. `target = []`.
2. For each `i`: `target.insert(index[i], nums[i])`.

`[0,1,2,3,4]`, `[0,1,2,2,1]` → `[0,4,1,3,2]`. `[1,2,3,4,0]`, `[0,1,2,3,0]` → `[0,1,2,3,4]`. `[1]`, `[0]` → `[1]`.

Do not assign `target[index[i]] = nums[i]`; inserts shift existing elements. With n ≤ 100, O(n²) inserts are fine.

Time: O(n²)  
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
