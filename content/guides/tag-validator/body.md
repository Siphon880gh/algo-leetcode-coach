## Three things can start at i

Walk index `i` with a stack of open tag names:

1. **CDATA** (`code` starts with `<![CDATA[` at `i`): only allowed when the stack is non-empty. Jump past the next `]]>`, or fail if there is none.
2. **Closing tag** (`</`): read the name up to `>`. It must be 1–9 uppercase letters and equal to the top of the stack. Pop it. If the stack is now empty, `i` must be at the end of `code`.
3. **Opening tag** (`<`): read the name up to `>`, check it is 1–9 uppercase letters, and push it.
4. **Anything else:** plain text, valid only when the stack is non-empty.

At the end, return true only if the stack is empty and at least one tag was seen.

Check CDATA before tags, because `<![` also starts with `<`. Inside CDATA, everything up to `]]>` is plain text, including `<`.

Do not accept text after the outer tag closes (`<A></A><B></B>` is invalid: the code must be one closed tag). Do not accept CDATA at the top level.

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
