## Both ends wrap

State: `a = [0] * k`, `head = 0`, `size = 0`.

- `insertFront(v)`: if full, false. `head = (head − 1 + k) % k`, `a[head] = v`, `size += 1`.
- `insertLast(v)`: if full, false. `a[(head + size) % k] = v`, `size += 1`.
- `deleteFront()`: if empty, false. `head = (head + 1) % k`, `size −= 1`.
- `deleteLast()`: if empty, false. `size −= 1`.
- `getFront()`: `a[head]`; `getRear()`: `a[(head + size − 1) % k]`; both −1 when empty.

This is Design Circular Queue (622) with operations at the front added. A doubly linked list also works, with O(1) operations and no wrapping.

Do not compute `(head − 1) % k` in a language where `%` can be negative; add `k` first. Do not use head and tail pointers without a size or a spare slot; `head == tail` is ambiguous.

Time: O(1) per operation  
Space: O(k)

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
