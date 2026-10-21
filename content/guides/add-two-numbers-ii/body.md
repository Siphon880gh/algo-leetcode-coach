Two non-empty lists of 1 to 100 digit nodes each, most significant digit first, no leading zeros except `0` itself. Return their sum as a list in the same order. Follow-up: do not reverse the input lists. `[7,2,4,3] + [5,6,4]` → `[7,8,0,7]` (7243 + 564 = 7807). `[2,4,3] + [5,6,4]` → `[8,0,7]`. `[0] + [0]` → `[0]`.

## Stacks, carry, prepend

Addition starts at the ones digit, but the lists start at the high digit. Push every value of each list onto its own stack. While either stack is non-empty or `carry` is nonzero: pop a digit from each (0 if empty), add with `carry`, set `carry = sum // 10`, and create a node with `sum % 10` whose `next` is the current head. Prepending builds the result high digit first without a final reverse.

Add Two Numbers (2) stores digits least significant first, so it walks both lists directly. Add Strings (415) does the same carry walk on strings.

Do not convert to integers — 100 digits overflow 64 bits. Do not forget the last carry (`[5] + [5]` → `[1,0]`). Reversing both inputs works but breaks the follow-up.

Time: O(m + n)  
Space: O(m + n) for the stacks

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
