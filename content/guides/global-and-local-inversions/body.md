## Look for a non-local inversion

Local inversions (`nums[i] > nums[i + 1]`) are a subset of global inversions. So the counts are equal iff no pair `i < j − 1` has `nums[i] > nums[j]`.

**Running max:** scan `j` from 2 and keep `mx = max(nums[0 … j − 2])`. If `mx > nums[j]`, return false.

**Permutation shortcut:** because the values are exactly `0 … n − 1`, an element more than one place away from its index forces a non-local inversion. So check `|nums[i] − i| ≤ 1` for all `i`.

Do not count both kinds of inversion with merge sort; that is O(n log n) for a question that needs O(n). Do not compare only adjacent elements; the danger is pairs at distance 2 or more.

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
