## Two kinds of ordered sets

1. `price[(shop, movie)]` from the entries.
2. `available[movie]` = sorted set of `(price, shop)`; `rented` = sorted set of `(price, shop, movie)`.
3. `rent`: remove from `available[movie]`, add to `rented`. `drop`: the reverse.
4. `search(movie)`: first five shops of `available[movie]`. `report()`: first five `[shop, movie]` of `rented`.

Example → `search(1) = [1,0,2]`, `report() = [[0,1],[1,2]]`, `search(2) = [0,1]`.

Tuple order encodes the tie-breaks directly (price, then shop, then movie). Lazy-deletion heaps also work but need care when an entry is rented and dropped repeatedly.

Time: O(log n) per update, O(1) to read five (O(5 log n) with heaps)  
Space: O(entries)

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
