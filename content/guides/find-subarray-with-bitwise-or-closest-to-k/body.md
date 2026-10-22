## Small OR sets

1. cur = {o | nums[i] for o in cur} ∪ {nums[i]}.
2. ans = min over cur of |k − o|.

Examples → 0, 1, 9. Checked against every subarray on 500 random arrays.

Single elements are not enough: example 1 → 1 instead of 0 (1 OR 2 = 3). Every subarray directly is about 5 · 10^9 at n = 10^5.

Time: O(30 n)  
Space: O(30)

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
