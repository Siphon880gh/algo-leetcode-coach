## dp(i, j)

1. dp(i, j): j is the kept leftover, i is the first untouched index.
2. i = n → nums[j]; i = n − 1 → max(nums[j], nums[i]).
3. Otherwise the minimum of:
   - max(nums[i], nums[i + 1]) + dp(i + 2, j)
   - max(nums[j], nums[i]) + dp(i + 2, i + 1)
   - max(nums[j], nums[i + 1]) + dp(i + 2, i)
4. Answer dp(1, 0).

Examples → 12, 5. Checked against trying every removal order on 500 random arrays.

Always removing the two smallest of the first three: [4, 8, 6, 5] → 14 instead of 13.

Time: O(n²)  
Space: O(n²)

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
