## Mark the unmatched

1. For each index: `(` → push; `)` → pop if the stack is non-empty, else mark this index.
2. Mark every index left on the stack.
3. Rebuild the string without marked indices.

`"lee(t(c)o)de)"` → `"lee(t(c)o)de"`. `"))(("` → `""`.

Every kept `)` has a match to its left, and every kept `(` has one to its right, and nothing else can be kept.

Do not remove from the string while scanning; indices shift and it costs O(n²). Do not forget the leftover `(` at the end.

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
