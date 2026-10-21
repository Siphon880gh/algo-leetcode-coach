## Two candidates

Two negatives make a positive, so after sorting the answer is

`max(a[n−1] · a[n−2] · a[n−3], a[0] · a[1] · a[n−1])`.

**One pass, O(n):** keep the three largest values `max1 ≥ max2 ≥ max3` and the two smallest `min1 ≤ min2`, updating them as you scan. Then return `max(max1 · max2 · max3, min1 · min2 · max1)`.

Do not take only the three largest; `[-10,-10,1,3,2]` → 300 from `−10 · −10 · 3`. Do not try `a[0] · a[1] · a[2]`; three small values can never beat the two candidates.

Time: O(n log n) with sorting, or O(n)  
Space: O(1)

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
