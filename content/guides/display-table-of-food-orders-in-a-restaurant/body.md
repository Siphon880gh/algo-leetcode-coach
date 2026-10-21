## Nested counts

1. `count[table][dish] += 1`; collect the set of dishes.
2. Header: `["Table"] + sorted(dishes)`.
3. For tables sorted by integer value: `[str(t)] + [str(count[t][d]) for d in dishes]`.

First example → header `["Table","Beef Burrito","Ceviche","Fried Chicken","Water"]`, then rows for tables 3, 5, 10.

Do not sort table numbers as strings; "10" would come before "3". Do not include customer names; they are ignored.

Time: O(n + T · D + D log D + T log T)  
Space: O(T · D)

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
