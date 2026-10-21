## Never expand the sample

- `total = Σ count[k]`, `mean = Σ k · count[k] / total`.
- `minimum` / `maximum`: first / last `k` with `count[k] > 0`.
- `mode`: the `k` with the largest `count[k]` (unique by the problem).
- `median`: find the values at positions `(total − 1) // 2` and `total // 2` (0-indexed) by walking cumulative counts; average them.

Return the five values as floats.

Do not build the full sample; it can hold 10⁹ values. Use 64-bit (or Python) integers for the weighted sum before dividing.

Time: O(256)  
Space: O(1)

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
