## Keep as many as possible

1. Count values at even indices and at odd indices; take the top two `(value, count)` of each (pad with count 0).
2. If the top values differ: return `n − e1 − o1`.
3. Else: return `n − max(e1 + o2, e2 + o1)`.

Examples → 3, 2. Checked against trying every value pair on 500 random arrays.

Changing to any positive integer means an unused value is always available, which is why a padded count of 0 is valid. A single-element array is already alternating.

Time: O(n)  
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
