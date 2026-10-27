## Tiny example

List A: `a1→a2→c1→c2→c3`  
List B: `b1→b2→b3→c1→c2→c3`  
The two lists share the nodes from `c1` onward, so the intersection starts at `c1`.

Use two pointers. Start `p` at the head of A and `q` at the head of B. Move both one node at a time. When a pointer runs off the end of its list, send it to the head of the **other** list.

Each pointer ends up walking A and B once, just in a different order, so both travel `lenA + lenB` steps. That lines them up, and they meet at `c1`. If the lists share no node, both reach null at the same time.

## How

1. Set `p` to the head of A and `q` to the head of B.
2. While `p` and `q` are different nodes:
   - Move `p` to `p.next`, or to the head of B if `p` is null.
   - Move `q` to `q.next`, or to the head of A if `q` is null.
3. Return `p`. It is the first shared node, or null.

## Trap

Comparing node **values** instead of the nodes themselves. Two different nodes can hold the same value.

**Fix:** The lists intersect where they share the same **node** (the same reference), not where values happen to be equal.

**Time:** O(m + n) · **Space:** O(1)

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
