## Parse, multiply, format

Split on `'+'` once: the left piece is `a`, the right piece without the trailing `'i'` is `b`. Parse both as integers (signs included). Do the same for `c` and `d`.

Since `i² = −1`: `(a + bi)(c + di) = (ac − bd) + (ad + bc)i`.

Return `f"{ac - bd}+{ad + bc}i"` — always a `'+'`, followed by the imaginary value, which carries its own minus sign.

Do not split on `'-'` — the minus belongs to the number. Do not write `"0-2i"`; the format is `"0+-2i"`. Do not forget the `−bd`: `i · i` is −1.

Time: O(1) (strings are short)  
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
