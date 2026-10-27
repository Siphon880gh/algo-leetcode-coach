`expression` of length 5 to 1e4 holds only digits, `T`, `F`, `?`, and `:`. It is a valid ternary, every number is one digit, and the result is a digit, `T`, or `F`. Ternaries group right to left, like most languages. `"T?2:3"` → `"2"`. `"F?1:T?4:5"` → `"4"` (read as `F ? 1 : (T ? 4 : 5)`). `"T?T?F:5:3"` → `"F"` (read as `T ? (T ? F : 5) : 3`). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Right to left, resolve at each ?

Scan from the last character back to the first. Skip `:`. Push digits, `T`, and `F` onto a stack. When you see `?`, the next character to its left is a condition, and the top two stack entries are its true branch (top) and false branch (below it). Pop both, push the true branch if the condition is `T`, else the false branch. Because the innermost right-hand ternary is always resolved first, nesting falls out for free. When the scan ends, the single stack entry is the answer.

A recursive parser works too: read the condition, recurse for the true branch, then match the `:` that balances it (count `?` vs `:`) and recurse for the false branch. Mini Parser (385) and Basic Calculator (224) are other stack-driven parsers.

Do not scan left to right with a plain stack and pop at each `:` — that groups the wrong way. Do not treat `T`/`F` only as conditions; they can also be results. Do not try to parse multi-digit numbers; every number is one digit.

Time: O(n)  
Space: O(n)

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
