## Memoized walk

1. Directions in clockwise order: (1, 1), (1, −1), (−1, −1), (−1, 1).
2. f(i, j, d, t): the next cell along d (or along d + 1 if t = 0, which sets t = 1) must hold the next value of the pattern; take the longer.
3. Answer max over 1-cells of 1, or 2 + f(next) where the first step lands on a 2.

Examples → 5, 4, 5, 1. Checked against walking every start, direction and turn point on 300 random grids.

Turning counter-clockwise instead: example 1 → 3 instead of 5.

Time: O(8 · nm)  
Space: O(8 · nm)

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
