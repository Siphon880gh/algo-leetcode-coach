## Preorder with one special case

`f(node)`:

- null → `""`
- leaf → `str(node.val)`
- no right child → `f"{val}({f(left)})"`
- otherwise → `f"{val}({f(left)})({f(right)})"`

The only empty pair that must stay is `()` for a missing left child when a right child exists. Without it, `1(2)` could mean either child. The rule shows up in the last case: `f(left)` is `""` there, which prints `()`.

Do not drop every empty pair; `[1,null,2]` must be `"1()(2)"`, not `"1(2)"`. Do not add `()` for a missing right child; that pair is never needed.

Time: O(n) with a string builder  
Space: O(h) recursion

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
