Given a linked list and integers m and n, repeatedly keep m nodes and then remove the next n nodes until the end, returning the head. For instance, 1→2→…→10 with m = 2, n = 3 becomes 1→2→6→7. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Keep, then cut

1. `cur = head`. While `cur`:
2. Move `cur` forward m − 1 times (stop if null).
3. `nxt = cur.next`; advance `nxt` n times (stop if null); `cur.next = nxt`; `cur = nxt`.

1→…→10, m = 2, n = 3 → 1→2→6→7.

Do not lose the link when fewer than n nodes remain; stop at null. Do not off-by-one the kept run; step m − 1 from its first node.

Time: O(length)  
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
