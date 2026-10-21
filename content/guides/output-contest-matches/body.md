`n` is `2^x` with `1 <= x <= 12`. Teams are ranked 1 (strongest) to `n`. Each round pairs the strongest remaining team with the weakest, the second strongest with the second weakest, and so on, and the winners keep the order of the stronger team. Return the bracket as a string. `n = 4` → `"((1,4),(2,3))"`. `n = 8` → `"(((1,8),(4,5)),((2,7),(3,6)))"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Fold the list in half each round

Start with `a = ["1", "2", …, str(n)]`. While `len(a) > 1`: build `b` where `b[i] = "(" + a[i] + "," + a[len(a) − 1 − i] + ")"` for `i < len(a) / 2`, then `a = b`. Return `a[0]`.

Each new string stands for the winner of that match, which is at position `i` — the stronger seed. That is why `(1,8)` pairs with `(4,5)` in round two: they are positions 0 and 3 of four.

Do not pair neighbors (`a[2i]` with `a[2i + 1]`) — that gives `((1,2),(3,4))`. Do not use spaces; the format has none.

Time: O(n log n) for string building  
Space: O(n log n) characters

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
