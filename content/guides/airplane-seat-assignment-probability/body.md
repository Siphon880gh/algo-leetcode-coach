## Symmetry between seat 1 and seat n

Each displaced passenger picks uniformly among the free seats. The process ends the moment seat 1 or seat n is taken, and at every step those two are equally likely to be chosen. If seat 1 goes first, the n-th passenger gets their own seat.

- `n = 1` → 1.0
- `n ≥ 2` → 0.5

The recurrence `f(n) = 1/n + Σ_{k=2}^{n−1} f(n − k + 1) / n` confirms it.

Do not simulate; n can be 10⁵ and the exact answer is known. Do not return 0.5 for `n = 1`; the only passenger always gets their seat.

Time: O(1)  
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
