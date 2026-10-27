## Right to left

1. pm[i] = max(nums[0 … i]); sm[i] = min(nums[i … n − 1]).
2. ans[n − 1] = pm[n − 1].
3. For i = n − 2 down to 0: ans[i] = ans[i + 1] if pm[i] > sm[i + 1], else pm[i].

Examples → [2, 2, 3], [3, 3, 3]. Checked against a search from every index on 2,000 random arrays.

Answering the prefix maximum alone: example 2 → [2, 3, 3] instead of [3, 3, 3].

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
