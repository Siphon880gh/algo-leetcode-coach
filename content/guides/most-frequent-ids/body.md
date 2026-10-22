## Lazy deletion

1. c[nums[i]] += freq[i]; push (c[nums[i]], nums[i]).
2. While the top’s count differs from the current c of its ID, pop it.
3. ans[i] = top count, or 0 if empty.

Examples → [3, 3, 2, 2], [2, 0, 1]. Checked against taking the maximum of all counts on 500 random valid inputs.

Removals can lower the maximum: keeping a running maximum gives example 1 → [3, 3, 3, 3]. One ID can reach 10^5 · 10^5 = 10^10 copies; use 64-bit.

Time: O(n log n)  
Space: O(n)

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
