## Fives are the flexible bill

`five = ten = 0`. For each bill:

- `5`: `five += 1`.
- `10`: if `five == 0` return false; else `five −= 1`, `ten += 1`.
- `20`: if `ten > 0 and five > 0`, use one of each; else if `five ≥ 3`, use three fives; else return false.

Return true.

Prefer the $10 for a $20: a $5 can make change for both $10 and $20, a $10 only for $20.

Twenties never need tracking; they are never given as change.

Do not track only the total cash; $20 in tens cannot change a $10. Do not spend three fives when a ten is available.

Time: O(n)  
Space: O(1)

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
