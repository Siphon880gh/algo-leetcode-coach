## State machine

Keep `inBlock = false` and a buffer `buf` that is **not** reset when a block comment spans lines.

For each line, scan with index `i`:

- `inBlock` and `line[i:i+2] == "*/"`: `inBlock = false`, `i += 2`.
- `inBlock`: `i += 1`.
- `line[i:i+2] == "/*"`: `inBlock = true`, `i += 2`.
- `line[i:i+2] == "//"`: stop scanning this line.
- Otherwise: append `line[i]` to `buf`, `i += 1`.

At the end of the line, if not `inBlock` and `buf` is non-empty, output `buf` and reset it. If still `inBlock`, keep `buf`: the code before `/*` joins the code after `*/` on a later line.

Do not treat `/*/` as opening and closing; skip 2 characters after `/*`. Do not reset the buffer at each line break inside a block, or `"a/*comment"`, `"line"`, `"more_comment*/b"` will not become `"ab"`.

Time: O(total characters)  
Space: O(total characters)

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
