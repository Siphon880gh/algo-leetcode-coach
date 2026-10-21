## Wrap with modulo

State: `a = [0] * k`, `head = 0`, `size = 0`.

- `enQueue(v)`: if `size == k`, return false. Write `a[(head + size) % k] = v`, `size += 1`.
- `deQueue()`: if `size == 0`, return false. `head = (head + 1) % k`, `size -= 1`.
- `Front()`: `a[head]`, or −1 when empty.
- `Rear()`: `a[(head + size − 1) % k]`, or −1 when empty.
- `isEmpty()`: `size == 0`; `isFull()`: `size == k`.

Keeping `size` avoids the classic ambiguity of a head and tail pointer, where `head == tail` could mean empty or full. The other fix is to allocate `k + 1` slots and keep one always empty.

Design Circular Deque (641) adds the front-side operations.

Do not shift elements on `deQueue`; moving the head is O(1). Do not compute `Rear` as `a[size − 1]`; once the queue wraps, the last item is not at the start of the array.

Time: O(1) per operation  
Space: O(k)

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
