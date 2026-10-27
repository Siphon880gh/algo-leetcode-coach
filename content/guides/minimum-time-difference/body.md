## Sort around the circle

Convert each time to `h · 60 + m` in `[0, 1440)`. Sort. The closest pair on a circle is two neighbors in sorted order, or the last and the first across midnight. So the answer is the minimum of `t[i + 1] − t[i]` and `t[0] + 1440 − t[-1]`.

Only 1440 distinct minutes exist, so with more than 1440 times there must be a duplicate: return 0 immediately. A 1440-entry boolean array (counting sort) also works and is O(n + 1440).

Do not forget the wrap — `"23:59"` and `"00:00"` are 1 minute apart, not 1439. Do not compare every pair; that is O(n²).

Time: O(n log n), or O(n + 1440) with buckets  
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
