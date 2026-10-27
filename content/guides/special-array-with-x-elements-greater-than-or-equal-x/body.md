## Check every candidate

1. For `x` in `0 .. n`: `c = #{v ≥ x}`.
2. If `c == x`, return `x`.
3. Return −1.

`[3,5]` → 2. `[0,0]` → −1. `[0,4,3,0,4]` → 3.

n ≤ 100 makes O(n²) fine; sorting plus binary search, or counting buckets, gives O(n log n) or O(n). Do not require x to be in the array.

Time: O(n²) simple, O(n) with buckets  
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
