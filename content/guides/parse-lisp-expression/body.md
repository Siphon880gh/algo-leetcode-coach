## Evaluate by form

Split into tokens: `(`, `)`, and words. `eval()` reads from the current position:

- A number token: return it.
- A name: return its value from the innermost scope that defines it.
- `(add e1 e2)` / `(mult e1 e2)`: evaluate both, combine, consume `)`.
- `(let v1 e1 v2 e2 … expr)`: push a new scope (a copy of the outer map, or a chained map). Repeatedly: if the next token is a name followed by something other than `)`, assign `v = eval()` in the new scope; otherwise evaluate the final expression. Pop the scope and consume `)`.

Assignments happen in order, so a later expression in the same `let` sees earlier variables, and a name may be reassigned.

Do not use one global map; inner `let`s must not leak their bindings out. Do not decide that a token is the final expression by whether it is a name; in `(let x 2 x)` the last `x` is the body, which you know because `)` follows it.

Time: O(n²) worst case with copied scopes  
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
