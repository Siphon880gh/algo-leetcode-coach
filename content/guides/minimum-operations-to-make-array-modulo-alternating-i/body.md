## Enumerate

1. cost(v, t) = min(d, k − d) with d = (v − t) mod k.
2. even[x] = Σ cost over even indices; odd[y] likewise.
3. Return min even[x] + odd[y] over x ≠ y.

Assumed here, as in the reference solution: a value may move either way around the residues.

Examples → 2, 1. Checked against trying every shift on 1,500 random cases.

Allowing x = y: example 2 → 0 instead of 1.

Time: O(n · k + k²)  
Space: O(k)

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
