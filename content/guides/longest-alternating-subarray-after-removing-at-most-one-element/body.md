## Join around each index

1. l1[i] / l2[i]: longest run ending at i whose last step goes up / down. r1[i] / r2[i]: longest run starting at i whose first step goes up / down.
2. ans = max of l1, l2.
3. For each i in 1 … n − 2: if nums[i − 1] < nums[i + 1], ans = max(ans, l2[i − 1] + r2[i + 1]); if >, ans = max(ans, l1[i − 1] + r1[i + 1]).
4. Return ans.

Examples → 4, 4, 1. Checked against trying every removal on 2,000 random arrays.

Never removing anything: example 2 → 3 instead of 4.

Time: O(n)  
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
