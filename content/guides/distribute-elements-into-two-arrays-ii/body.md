## Two Fenwick trees

1. Compress values to ranks. arr1 = [nums[1]], arr2 = [nums[2]]; add their ranks to trees t1 and t2.
2. For each later x with rank r: g1 = |arr1| − t1.count(≤ r), g2 likewise.
3. Append to arr1 if g1 > g2, or g1 = g2 and |arr1| ≤ |arr2|; else to arr2. Update that tree.
4. Return arr1 + arr2.

Examples → [2, 3, 1, 3], [5, 3, 1, 2, 14], [3, 3, 3, 3]. Checked against counting directly on 2,000 random arrays.

On equal counts, the shorter array wins before arr1 does: always choosing arr1 gives [1, 1, 3, 4] → [1, 3, 4, 1] instead of [1, 3, 1, 4]. Counting directly is O(n²), about 10^10 at n = 10^5.

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
