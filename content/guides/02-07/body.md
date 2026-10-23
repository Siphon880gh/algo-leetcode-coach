## Tiny example

List A: `a1→a2→c1→c2→c3`  
List B: `b1→b2→b3→c1→c2→c3`  
Intersection starts at `c1`.

Two pointers: start `p=A.head`, `q=B.head`. When a pointer hits null, redirect it to the **other** head. They travel `lenA+lenB` in different orders and meet at `c1` (or both null if no intersection).


## How

1. p,q at heads
2. While p is not q: p = p.next or other head if null; same for q
3. Return p


## Trap

Comparing node **values** instead of node identity — duplicates fool you.

**Fix:** Intersect means shared **nodes** (same reference), not equal values.

**Time:** O(m+n) · **Space:** O(1)

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
