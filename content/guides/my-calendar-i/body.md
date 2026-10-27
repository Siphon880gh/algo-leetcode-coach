## Half-open overlap

Two half-open intervals `[s1, e1)` and `[s2, e2)` overlap exactly when `s1 < e2 and s2 < e1`.

**Simple:** keep a list of bookings and test the new one against each. O(n) per call, O(n²) total, fine for 1000 calls.

**Sorted:** keep starts in a sorted structure (a balanced BST or sorted list). For `book(s, e)`:

- Find the first booking with start `≥ s`. It must start at or after `e`.
- The booking before it must end at or before `s`.

If both hold, insert and return true.

A sorted Python list with `bisect.insort` is O(n) per insert because of shifting, but fast in practice; a tree map gives O(log n).

Do not treat touching intervals as overlapping; `[10, 20)` and `[20, 30)` can both be booked.

Time: O(log n) per booking with a balanced tree  
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
