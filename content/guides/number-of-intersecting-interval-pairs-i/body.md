## Example first

intervals = [[1, 2], [2, 3], [3, 4]]. There are 3 pairs.

1. [1, 2] and [2, 3] share the point 2. They intersect.
2. [2, 3] and [3, 4] share the point 3. They intersect.
3. [1, 2] and [3, 4] miss: 2 < 3.

Answer 3 − 1 = 2.

## Steps

1. total = n(n − 1) / 2.
2. Two closed intervals are disjoint exactly when one ends strictly before the other starts.
3. Sort the starts and, separately, the ends.
4. For each start s, move a pointer over the ends while end < s. The pointer position is how many intervals finished before s. Subtract it.

Each disjoint pair is subtracted once, at the later start. n ≤ 100, so checking every pair also passes.

## Trap

Treating touching intervals as disjoint. Example 1 then gives 0 instead of 2. Fix: use end < start, not end ≤ start.

Checked: the examples give 2, 3 and 0, and the sweep matched checking every pair on 300 random inputs.

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
