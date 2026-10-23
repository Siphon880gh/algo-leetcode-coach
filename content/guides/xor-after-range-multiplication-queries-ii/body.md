## Two cases

1. B = ⌊√n⌋.
2. k ≥ B: multiply nums[l], nums[l + k], … directly.
3. k < B: mul_k[l] ·= v; e = l + ((r − l) / k + 1) · k; mul_k[e] ·= v^(p − 2) (the inverse).
4. For each small k: mul_k[i] ·= mul_k[i − k] for i ≥ k, then nums[i] ·= mul_k[i].
5. Return the XOR.

Examples → 4, 31. Checked against direct simulation on 1,500 random cases.

Cancelling at r + 1 instead of the next index in the progression: ten 1s, query [0, 4, 2, 3] (step 2 is small) → 333333339 instead of 2.

Time: O((n + q) · √n + q log p)  
Space: O(n · √n)

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
