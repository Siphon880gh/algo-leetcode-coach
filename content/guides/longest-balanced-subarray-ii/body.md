## Sweep r

1. Segment tree over l with range add, min and max.
2. For each r: s = +1 if nums[r] is odd, else −1; add s on [last[nums[r]] + 1, r]; last[nums[r]] = r.
3. l = leftmost index ≤ r with min ≤ 0 ≤ max in its node, walking down from the root. If found, update the answer with r − l + 1.
4. Return the answer.

Examples → 4, 5, 3. Checked against testing every subarray on 3,000 random arrays.

Adding ±1 on all of [0, r] for every element, not just after its previous occurrence: that counts repeats, so example 2 → 4 instead of 5.

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
