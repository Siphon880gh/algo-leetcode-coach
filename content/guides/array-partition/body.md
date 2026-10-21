## Pair neighbors after sorting

The smallest value is the min of its pair no matter what, so pair it with the next smallest to waste as little as possible. Repeat. After sorting, the answer is `sum(nums[0::2])`.

Since values are in a small range, counting sort makes it O(n + range).

Do not pair smallest with largest — `(1,4)`, `(2,3)` gives 3, not 4. Do not add the odd indexes; those are the pair maximums.

Time: O(n log n), or O(n + range)  
Space: O(1) besides sorting

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
